# Modules

## Информация
> Модули: <br>
- Form API

## Установка

``` bash
# Обновите индекс пакетов
$ sudo apt-get update
$ sudo apt-get upgrade -y

# Установить CURL
$ sudo apt install apt-transport-https ca-certificates curl software-properties-common

# Установить nodejs из репозитории
$ curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
$ sudo apt-get install -y nodejs

# Установить YARN
$ curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
$ echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
$ sudo apt-get update && sudo apt-get install yarn

# Установить DOCKER из репозитории
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
$ sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"
$ sudo apt update && sudo apt install docker-ce

# Установить LANDO из репозитории
$ git clone https://github.com/lando/lando.git
$ cd lando && yarn
$ sudo mkdir -p /usr/local/bin
$ sudo ln -s /absolute/path/to/above/repo/bin/lando.js /usr/local/bin/lando.dev

# Скопируйте репозиторий
git clone https://gitlab.com/adci/internship/nikita-naydenov-theme.git

# Запуск приложения
$ cd nikita-naydenov-theme
$ lando init
$ lando start
