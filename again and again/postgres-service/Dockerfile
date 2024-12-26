FROM postgres:16

COPY ./DATABASE.sql /docker-entrypoint-initdb.d/DATABASE.sql

ENV POSTGRES_USER=ehc_child
ENV POSTGRES_PASSWORD=password
ENV POSTGRES_DB=hell_ehc

# Sao chép entrypoint.sh vào container
# COPY entrypoint.sh /entrypoint.sh

# # Cấp quyền thực thi cho entrypoint.sh
# RUN chmod +x /entrypoint.sh

# # Đặt entrypoint
# ENTRYPOINT ["/entrypoint.sh"]