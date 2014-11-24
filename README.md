# Using Eloquent with Slim
Most of the documentation I've seen up till now about using Eloquent outside of Laravel makes it use the static methods in order to access the models. While this is fine, it jars slightly with how I use Slim, where I put the repositories/mappers/whatever inside the Slim app container and access them using instance methods. Here's a demo of how I do it. You can check it out and run it, like so:

```bash
git clone https://github.com/mgdm/Slim-Eloquent.git
cd Slim-Eloquent
composer install
php -S localhost:8080
```
You'll also need access to a MySQL database, and to load the data from `create.sql` into it, and give the app access to it. The app will then be available on `http://localhost:8080`. 

Most of the work is done inside `index.php`, where the repositories for the `Authors` and `Books` are set up as singletons in the Slim app container.