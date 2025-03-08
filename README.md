Clonar projeto
Trocar o .env (Whatsapp)
Trocar o Docker-compose.yml (Whatsapp)
Trocar composer.json (Whatsapp)
Rodar o comando no terminal
    
    docker compose up --build

Em seguida rodar o comando 

    docker exec -it dymobcliente-app-1 bash

Agora dentro do container rodar o comando 

    composer install

Em seguida rodar o comando

    npm install

Em seguida rodar o comando

    npm run build

Em seguida rodar o camando 

    npm run dev
# projeto-caf
