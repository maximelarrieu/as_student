#!/usr/bin/python3

from libmatrice import *

mat=[ [-3, -3, -4],
      [0, 1, 1],
      [4, 3, 4] ]
print('MATRICE DE BASE')
print(mat,'\n')

print('ON RECUPERE LE DETERMINANT 2')
determinant2=det2(mat)
print(determinant2,'\n')

print('ON RECUPERE LE DETERMINANT 3')
determinant3=det3(mat)
print(determinant3,'\n')

print('MATRICE REDUITE')
#reduite=reduit(mat)
#print(reduite, '\n')
