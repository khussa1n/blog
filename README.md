
# Blog

Краткое описание проекта.

## Setup

Чтобы начать работу с этим проектом, убедитесь, что на вашем компьютере установлены php ^8.2 и Composer. 

Все данные для базы в database/database.sqlite

Вы можете запустить сервер без установки зависимостей. Папка  vendor уже есть.

### Steps:

1. **Clone the repository**

    ```bash
    git clone https://github.com/khussa1n/blog.git
   
    cd blog
    ```

2. **Start Laravel server**

    ```bash
    php artisan serve
    ```

### Users:
1) admin - E-mail: ```admin@mail.com```
    Пароль: ```12345678```
2) moderator - E-mail: ```moderator@mail.com```
   Пароль ```12345678``` 
3) обычный пользователь - E-mail: ```khussain@mail.kz```
   Пароль ```12345678```


### DB diagram

<img alt="DB diagram" src="schema.png"/>
