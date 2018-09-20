# phpubsub

Great name, I know.

## what is it?

This super simple application uses long polling and the `LISTEN` and `NOTIFY` postgres commands to allow for real-time updates in php. Essentially, the browser makes a request to the server, and the server starts an infinite loop, until it gets a notification (or there is a timeout, which is not handled). As soon as there is a notification, the database is queried for all new stuff, which is then sent to the client. As soon as the client receives the response, it makes a new request, to be held open again. This is called long polling. Kinda like websockets, but sketchier. Because of javascript's asynchronous IO, this request can be held open without any horrible consequences. This example allows you to send a message while waiting on a response to the polling.

## how do I use it?

Just change the password and host in `connection.php` to your postgres database, and then run the application however you want (as long as it's not with `php -S localhost:8080` or similar, since the infinite loop will block the thread).

Don't expect anything *that* interesting.

