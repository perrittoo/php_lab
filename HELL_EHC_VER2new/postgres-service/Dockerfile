FROM postgres:16

COPY ./DATABASE.sql /docker-entrypoint-initdb.d/DATABASE.sql
COPY flag.txt /flag.txt
RUN chmod 400 /flag.txt

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
RUN "./entrypoint.sh"