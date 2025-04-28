This is the basic setup for the a Vue3 interface backed by a Symfony REST API.

To setup your local instance, run `./setup.sh`. This command will build the local docker images, install php and npm dependencies, and start the containers.

After that, you should be able to navigate to localhost:3000 and see changes you make live. The API will be available at localhost:8000.

The Symfony based PHP code can be found in `/backend`:
- Symfony Documentation: https://symfony.com/doc/current/index.html

The Vue3 code can be found in `/frontend`:
- Vue3 Documentation: https://vuejs.org/guide/introduction.html