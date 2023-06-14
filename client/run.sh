#!/bin/bash

docker run -it -p 3000:3000 -p 24678:24678 --env CHOKIDAR_USEPOLLING=true --rm --name smartHouse -v "$PWD":/usr/src/app -w /usr/src/app node:18 npm run serve