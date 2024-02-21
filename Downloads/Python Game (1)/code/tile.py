'''
Module tiles to mock the tiles of the game.
'''


from typing import Tuple

import pygame


class Tile(pygame.sprite.Sprite):
    '''
    Tile sprite class
    '''

    def __init__(self, position: Tuple, size: int) -> None:
        super().__init__()
        self.image = pygame.Surface((size, size))
        self.image.fill('grey')
        self.rect = self.image.get_rect(topleft=position)

    def update(self, direction: int) -> None:
        '''
        Function to update the tile
        '''
        self.rect.y += direction


class StaticTile(Tile):
    '''
    Function to create static tile
    '''

    def __init__(self, position: Tuple, size: int, image: pygame.Surface) -> None:
        super().__init__(position, size)
        self.image = image
