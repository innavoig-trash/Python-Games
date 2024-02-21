'''
Module for bomb class
'''


import os
from msilib.schema import SelfReg
from typing import Tuple

import pygame
from constant import *
from helper import import_folder


class Bomb(pygame.sprite.Sprite):
    '''
    Bomb sprite class
    '''

    ANIMATIONFRAME = 20

    def __init__(self, position: Tuple) -> None:
        super().__init__()

        # import sprite
        self.sprite = None
        self.import_sprite()

        # animation
        self.anim_frame = 0
        self.anim_index = 0
        self.image = self.sprite['off'][0]

        '''
        edit position y - 20
        '''
        position = (position[0], position[1] - 36)

        self.rect = self.image.get_rect(topleft=position)

        # states
        self.state = 'off'

    def import_sprite(self) -> None:
        '''
        Function to import sprite from assets folder
        '''
        path = os.path.join(ASSETS, 'bomb')

        self.sprite = {
            'off': [],
            'on': [],
            'explode': []
        }

        for key, _ in self.sprite.items():
            fullpath = os.path.join(path, key)
            self.sprite[key] = import_folder(fullpath)

    def animate(self) -> None:
        '''
        Function to animate sprite
        '''
        animation = self.sprite[self.state]
        self.anim_frame += 1 / (FRAME / self.ANIMATIONFRAME)

        self.anim_frame %= len(animation)
        self.image = animation[int(self.anim_frame)]

    def trigger(self) -> None:
        '''
        Function to turn on bomb
        '''
        self.state = 'on'

    def handle_state(self) -> None:
        '''
        Function to handle state of bomb
        '''
        animation = self.sprite[self.state]

        # if explode and animation is done, kill
        if self.state == 'explode' and int(self.anim_frame) == len(animation) - 1:
            self.kill()

        # if on and animation is done, explode
        if self.state == 'on' and int(self.anim_frame) == len(animation) - 1:
            self.state = 'explode'

    def update(self, dy: int) -> None:
        '''
        Function to update sprite
        '''
        self.rect.y += dy
        self.animate()
        self.handle_state()
