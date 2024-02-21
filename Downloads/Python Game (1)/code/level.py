'''
Module for mocking the levels of the game.
'''


import os
from turtle import back
from typing import Dict, List

import pygame
from bomb import Bomb
from constant import *
from helper import *
from player import Player
from tile import StaticTile, Tile


class Level:
    '''
    Class for game level
    '''

    def __init__(self, level: Dict, surface: pygame.Surface) -> None:
        # general setup
        self.surface = surface
        self.shift = 0
        self.current_x = None

        # player
        character = import_csv_layout(level['character'])
        self.start = pygame.sprite.GroupSingle()
        self.finish = pygame.sprite.GroupSingle()
        self.enemies = pygame.sprite.Group()
        self.player_setup(character)

        # background setup
        background = import_csv_layout(level['background'])
        self.background = self.create_tile_group(background, 'background')

        # wall setup
        wall = import_csv_layout(level['wall'])
        self.wall = self.create_tile_group(wall, 'wall')

        # ornament setup
        ornament = import_csv_layout(level['ornament'])
        self.ornament = self.create_tile_group(ornament, 'ornament')

        # bomb setup
        bomb = import_csv_layout(level['bomb'])
        self.bombs = pygame.sprite.Group()
        self.bomb_setup(bomb)

        # start state
        self.initialize = True
        self.gameover = False
        self.gamefinish = False

    def create_tile_group(self, layout, tile) -> pygame.sprite.Group:
        '''
        Function to create tile group
        '''
        group = pygame.sprite.Group()

        for row, lines in enumerate(layout):
            for col, value in enumerate(lines):
                if value != '-1':
                    position = (col * TILESIZE, row * TILESIZE)

                    if tile == 'background':
                        tilemap = import_cut_graphics(os.path.join(ASSETS, 'background', 'tilemap.png'))
                        surface = tilemap[int(value)]
                        sprite = StaticTile(position, TILESIZE, surface)
                        group.add(sprite)

                    if tile == 'wall':
                        tilemap = import_cut_graphics(os.path.join(ASSETS, 'background', 'tilemap.png'))
                        surface = tilemap[int(value)]
                        sprite = StaticTile(position, TILESIZE, surface)
                        group.add(sprite)

                    if tile == 'ornament':
                        ornaments = [
                            'Skull.png',
                            'Table.png',
                            'Windows.png',
                            'Barrel.png',
                            'Blue Bottle.png',
                            'Chair.png',
                            'Green Bottle.png',
                            'Red Bottle.png',
                        ]

                        path = os.path.join(ASSETS, 'ornament', ornaments[int(value)])
                        surface = pygame.image.load(path).convert_alpha()
                        surface_size = surface.get_size()
                        position = (position[0] + (TILESIZE - surface_size[0]), position[1] + (TILESIZE - surface_size[1]))
                        sprite = StaticTile(position, TILESIZE, surface)
                        group.add(sprite)

        return group

    def player_setup(self, layout) -> None:
        '''
        Function to setup the player
        '''

        for row, lines in enumerate(layout):
            for col, value in enumerate(lines):
                position = (col * TILESIZE, row * TILESIZE)

                if value == '0':
                    sprite = Player(position)
                    self.start.add(sprite)

                if value == '1':
                    enemy = pygame.image.load(os.path.join(ASSETS, 'other', 'enemy.png')).convert_alpha()
                    sprite = StaticTile(position, TILESIZE, enemy)
                    self.enemies.add(sprite)

                if value == '2':
                    door = pygame.image.load(os.path.join(ASSETS, 'other', 'door.png')).convert_alpha()
                    surface_size = door.get_size()
                    position = (position[0] + 20, position[1] + (TILESIZE - surface_size[1]))
                    sprite = StaticTile(position, TILESIZE, door)
                    self.finish.add(sprite)

    def bomb_setup(self, layout) -> None:
        '''
        Function to setup the bombs
        '''
        for row, lines in enumerate(layout):
            for col, value in enumerate(lines):
                position = (col * TILESIZE, row * TILESIZE)

                if value == '3':
                    sprite = Bomb(position)
                    self.bombs.add(sprite)

    def scroll_y(self) -> None:
        '''
        Function to scroll the level
        '''
        player = self.start.sprite
        player_y = player.rect.centery
        direction_y = player.direction.y

        clamp_top, clamp_button = (HEIGHT / 4, HEIGHT - HEIGHT / 4)

        # initialize (scroll down)
        if player_y > clamp_button and self.initialize:
            self.shift -= player.GRAVITY
        elif player_y < clamp_button and self.initialize:
            self.initialize = False

        # while player not on screen yet shift += GRAVITY
        elif player_y < clamp_top and direction_y < 0:
            self.shift += player.GRAVITY
        elif player_y > clamp_button and direction_y > 0:
            self.shift -= player.GRAVITY
        else:
            self.shift = 0

    def horizontal_movement(self) -> None:
        '''
        Function to check horizontal collision
        '''
        player = self.start.sprite
        player.rect.x += player.direction.x * player.speed

        # check collision
        for wall in self.wall.sprites():
            if wall.rect.colliderect(player.rect):
                if player.direction.x < 0:
                    player.rect.left = wall.rect.right
                    player.on_left = True
                    self.current_x = player.rect.left
                elif player.direction.x > 0:
                    player.rect.right = wall.rect.left
                    player.on_right = True
                    self.current_x = player.rect.right

        if player.on_left and (player.rect.left < self.current_x or player.direction.x >= 0):
            player.on_left = False
        if player.on_right and (player.rect.right > self.current_x or player.direction.x <= 0):
            player.on_right = False

    def vertical_movement(self) -> None:
        '''
        Function to check vertical collision
        '''
        player = self.start.sprite
        player.apply_gravity()

        # check collision
        for wall in self.wall.sprites():
            if wall.rect.colliderect(player.rect):
                if player.direction.y > 0:
                    player.rect.bottom = wall.rect.top
                    player.direction.y = 0
                    player.on_ground = True
                elif player.direction.y < 0:
                    player.rect.top = wall.rect.bottom
                    player.direction.y = 0
                    player.on_ceiling = True

        if player.on_ground and player.direction.y < 0 or player.direction.y > 1:
            player.on_ground = False
        if player.on_ceiling and player.direction.y > 0.1:
            player.on_ceiling = False

    def handle_gameover(self) -> None:
        '''
        Function to handle game over
        '''
        player = self.start.sprite
        if player.cankill:
            self.gameover = True

    def handle_gamefinish(self) -> None:
        '''
        Function to handle game finish
        '''
        player = self.start.sprite
        finish = self.finish.sprite

        if finish.rect.colliderect(player.rect):
            player.state = 'door'

        if player.canfinish:
            self.gamefinish = True

    def handle_gamelogic(self) -> None:
        '''
        Function to handle the game logic
        '''
        player = self.start.sprite

        # collision with bomb, if player is on the bomb trigger bomb
        for bomb in self.bombs.sprites():
            if bomb.rect.colliderect(player.rect):
                if bomb.state != 'explode':
                    bomb.trigger()
                else:
                    player.state = 'hit'
                    player.health = max(0, player.health - 5)

    def display_health(self) -> None:
        '''
        Function to display the health
        '''
        font = load_font(32)
        health = font.render(f'Health: {self.start.sprite.health}', True, (255, 255, 255))
        self.surface.blit(health, (20, 20))

    def run(self) -> None:
        '''
        Function to run the level
        '''

        # update
        self.scroll_y()
        self.start.update(self.shift)
        self.background.update(self.shift)
        self.wall.update(self.shift)
        self.enemies.update(self.shift)
        self.finish.update(self.shift)
        self.ornament.update(self.shift)
        self.bombs.update(self.shift)

        # draw
        self.background.draw(self.surface)
        self.finish.draw(self.surface)
        self.ornament.draw(self.surface)
        self.enemies.draw(self.surface)
        self.bombs.draw(self.surface)
        self.wall.draw(self.surface)

        # player draw
        self.horizontal_movement()
        self.vertical_movement()
        self.start.draw(self.surface)

      # handle game
        self.handle_gamelogic()
        self.handle_gameover()
        self.handle_gamefinish()
        self.display_health()
