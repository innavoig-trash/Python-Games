'''
Helper function to load images and level layout
'''

import os
from csv import reader
from os import walk

import pygame
from constant import ASSETS, TILESIZE


def import_folder(path) -> list:
    '''
    Function to load all image in the folder
    '''
    surfaces = []
    for _, _, images in walk(path):
        for image in images:
            imgpath = os.path.join(path, image)
            surface = pygame.image.load(imgpath).convert_alpha()
            surfaces.append(surface)
    return surfaces


def import_csv_layout(path) -> list:
    '''
    Function to import level layout
    '''
    terrains = []
    with open(path, encoding='utf-8') as terrain:
        level = reader(terrain, delimiter=',')
        for row in level:
            terrains.append(list(row))
        return terrains


def import_cut_graphics(path) -> list:
    '''
    Function to cut the tileset and return a list of tiles
    '''
    surface = pygame.image.load(path).convert_alpha()
    size = surface.get_size()
    cols, rows = (size[0] // TILESIZE, size[1] // TILESIZE)

    tiles = []
    for row in range(rows):
        for col in range(cols):
            position = [col * TILESIZE, row * TILESIZE]
            new_surf = pygame.Surface((TILESIZE, TILESIZE), flags=pygame.SRCALPHA)
            new_surf.blit(surface, (0, 0), pygame.Rect(*position, TILESIZE, TILESIZE))
            tiles.append(new_surf)

    return tiles


def load_font(size) -> pygame.font.Font:
    '''
    Function to load font
    '''
    path = os.path.join(ASSETS, 'fonts', 'connection.otf')
    return pygame.font.Font(path, size)
