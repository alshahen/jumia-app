# JUMIA CUSTOMERS APP
here is my implementation for the Jumia recruitment test
## installation
1- clone the git repository
```bash 
git clone https://github.com/alshahen/jumia-app.git
```

2- go to jumia app
```bash 
cd jumia-app
```

3- we need to install our package dependency
> please make sure your user is added to the docker group before running the commands if not then run the following commands. 

Create the docker group
```bash 
sudo groupadd docker
```

Add your user to the docker group

```bash 
sudo usermod -aG docker ${USER}
```

You would need to log out and log back in

```bash 
su - ${USER}
```

now you ready to install packages
```bash 
docker run --rm -v $(pwd):/app composer/composer install
```

4- build the docker image

```bash 
./vendor/bin/sail up -d
```

5- run the configuration commands

```bash 
bash install_config.sh
```

6- go to http://localhost

## testing

to run tests 

```bash 
./vendor/bin/sail artisan test
```
