FROM node:10-slim

ARG NODE_ENV=development
ENV NODE_ENV=${NODE_ENV}

WORKDIR /home/node/app

COPY package*.json ./
RUN npm install

COPY . .

CMD [ "npm", “run”, "start:prod" ]