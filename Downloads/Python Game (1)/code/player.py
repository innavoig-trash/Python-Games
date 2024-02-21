'''
Module for player class
'''

import os
from typing import Tuple

import pygame
from constant import *
from helper import import_folder


class Player(pygame.sprite.Sprite):
    '''
    Player sprite class
    '''

    MAXSPEED = 5
    GRAVITY = .6
    JUMPSPEED = -20
    ANIMATIONFRAME = 20

    def __init__(self, position: Tuple) -> None:
        super().__init__()

        # import sprite
        self.sprite = None
        self.import_sprite()

        # animation
        self.anim_frame = 0
        self.anim_index = 0
        self.image = self.sprite['idle'][0]
        self.rect = self.image.get_rect(topleft=position)

        # movement
        self.direction = pygame.math.Vector2(0, 0)
        self.speed = self.MAXSPEED

        # states
        self.state = 'idle'
        self.left = False

        self.on_ground = False
        self.on_ceiling = False
        self.on_left = False
        self.on_right = False

        # health
        self.health = 100
        self.cankill = False
        self.canfinish = False

    def import_sprite(self) -> None:
        '''
        Function to import sprite from assets folder
        '''
        path = os.path.join(ASSETS, 'player')

        self.sprite = {
            'idle': [],
            'run': [],
            'jump': [],
            'fall': [],
            'hit': [],
            'dead': [],
            'door': [],
        }

        for key, _ in self.sprite.items():
            fullpath = os.path.join(path, key)
            self.sprite[key] = import_folder(fullpath)

    def handle_state(self) -> None:
        '''
        Function to get the state of the player
        '''
        if self.state in ['hit', 'dead', 'door']:
            pass
        elif self.direction.y < 0:
            self.state = 'jump'
        elif self.direction.y > self.GRAVITY:
            self.state = 'fall'
        else:
            self.state = 'run' if self.direction.x != 0 else 'idle'

    def animate(self) -> None:
        '''
        Function to animate the player
        '''
        animation = self.sprite[self.state]

        self.anim_frame += 1 / (FRAME / self.ANIMATIONFRAME)
        self.anim_frame %= len(animation)

        image = animation[int(self.anim_frame)]
        self.image = pygame.transform.flip(image, self.left, False)

        if self.state == 'door' and int(self.anim_frame) == len(animation) - 1:
            self.canfinish = True

        if self.state == 'dead' and int(self.anim_frame) == len(animation) - 1:
            self.cankill = True

        if self.state == 'hit' and int(self.anim_frame) == len(animation) - 1:
            self.state = 'idle'

        if self.health <= 0:
            self.state = 'dead'

        # set the rect
        if self.on_ground and self.on_right:
            self.rect = self.image.get_rect(bottomright=self.rect.bottomright)
        elif self.on_ground and self.on_left:
            self.rect = self.image.get_rect(bottomleft=self.rect.bottomleft)
        elif self.on_ground:
            self.rect = self.image.get_rect(midbottom=self.rect.midbottom)
        elif self.on_ceiling and self.on_right:
            self.rect = self.image.get_rect(topright=self.rect.topright)
        elif self.on_ceiling and self.on_left:
            self.rect = self.image.get_rect(topleft=self.rect.topleft)
        elif self.on_ceiling:
            self.rect = self.image.get_rect(midtop=self.rect.midtop)

    def handle_input(self) -> None:
        '''
        Function to handle user input
        '''

        key = pygame.key.get_pressed()

        if self.state in ['hit', 'dead']:
            pass
        elif key[pygame.K_LEFT]:
            self.direction.x = -1
            self.left = True
        elif key[pygame.K_RIGHT]:
            self.direction.x = 1
            self.left = False
        else:
            self.direction.x = 0

        if self.state in ['hit', 'dead']:
            pass
        elif key[pygame.K_UP] and self.on_ground:
            self.apply_jump()

    def apply_gravity(self) -> None:
        '''
        Function to apply gravity to the player
        '''
        self.direction.y += self.GRAVITY
        self.rect.y += self.direction.y

    def apply_jump(self) -> None:
        '''
        Function to apply jump to the player
        '''
        if self.direction.y == 0:
            self.direction.y = self.JUMPSPEED

    def update(self, dy: int) -> None:
        '''
        Function to update the player
        '''
        self.rect.y += dy
        self.handle_input()
        self.handle_state()
        self.animate()
