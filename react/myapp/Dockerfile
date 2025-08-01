FROM nginx-nodejs-kylin-for-arm:latest

WORKDIR /var/www/html

COPY ./dist .

RUN chmod 777 /var/www/html -R

CMD ["/usr/local/nginx/sbin/nginx", "-g", "daemon off;", "-c", "/usr/local/nginx/conf/nginx.conf"]

#CMD ["sleep", "infinity"]
