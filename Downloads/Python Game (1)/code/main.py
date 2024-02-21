'''
Main module of the game
'''

import os
import sys

import pygame
from constant import *
from helper import load_font
from level import Level
from pygame.locals import *
from tile import Tile


class Game:
    '''
    Main class of the game
    '''

    def __init__(self) -> None:
        self.screen = pygame.display.set_mode((WIDTH, HEIGHT))
        self.clock = pygame.time.Clock()
        self.level = Level(LEVEL[0], self.screen)

    def run(self) -> None:
        '''
        Main loop of the game
        '''
        while True:
            for event in pygame.event.get():
                if event.type == pygame.QUIT:
                    pygame.quit()
                    sys.exit()
                if self.level.gameover or self.level.gamefinish:
                    if event.type == pygame.KEYDOWN:
                        if event.key == pygame.K_SPACE:
                            self.loading_screen()
                            self.level = Level(LEVEL[0], self.screen)

            self.screen.fill(PRIMARY)

            if self.level.gameover:
                self.gameover_screen()
            elif self.level.gamefinish:
                self.gamefinish_screen()
            else:
                self.level.run()

            pygame.display.update()
            self.clock.tick(FRAME)

    def gameover_screen(self) -> None:
        '''
        Game over screen
        '''
        self.screen.fill(PRIMARY)

        # create text
        font = load_font(50)
        text = font.render('Game Over', True, (255, 255, 255))
        text_rect = text.get_rect()
        text_rect.center = (WIDTH / 2, HEIGHT / 2)

        # create text space to restart
        font = load_font(30)
        text_space = font.render('Press Space to Restart', True, (255, 255, 255))
        text_space_rect = text_space.get_rect()
        text_space_rect.center = (WIDTH / 2, HEIGHT / 2 + 50)

        # draw text
        self.screen.blit(text, text_rect)
        self.screen.blit(text_space, text_space_rect)

    def loading_screen(self) -> None:
        '''
        Loading screen
        '''
        self.screen.fill(PRIMARY)

        # create text
        font = load_font(50)
        text = font.render('Loading...', True, (255, 255, 255))
        text_rect = text.get_rect()
        text_rect.center = (WIDTH / 2, HEIGHT / 2)

        # draw text
        self.screen.blit(text, text_rect)
        pygame.display.update()

    def gamefinish_screen(self) -> None:
        '''
        Game finish screen
        '''
        self.screen.fill(PRIMARY)

        # create text
        font = load_font(50)
        text = font.render('You Win', True, (255, 255, 255))
        text_rect = text.get_rect()
        text_rect.center = (WIDTH / 2, HEIGHT / 2)

        # create text space to restart
        font = load_font(30)
        text_space = font.render('Press Space to Restart', True, (255, 255, 255))
        text_space_rect = text_space.get_rect()
        text_space_rect.center = (WIDTH / 2, HEIGHT / 2 + 50)

        # draw text
        self.screen.blit(text, text_rect)
        self.screen.blit(text_space, text_space_rect)


def main() -> None:
    '''
    Main function to start the game
    '''
    # initialize pygame
    pygame.init()
    pygame.display.set_caption('Platformer Game')

    # run game
    game = Game()
    game.run()
    return


if __name__ == '__main__':
    # set directory and run game
    os.chdir(os.path.dirname(os.path.abspath(__file__)))
    main()