# Virtual Market
Esquema de la base de datos

## Clientes
- id
- name
- app
- apm
- dir
- cp
- tel
- mail
- password
- rol

## Categoría
- id
- nombre
- condiciones
- observaciones

## Dimensiones
- id
- volumen
- peso

## Productos
- id
- nombre
- marca
- origen
- fotografia
- id_categoria [[esquema#Categoría]]
- stock
- id_dimensiones [[esquema#Dimensiones]]]
