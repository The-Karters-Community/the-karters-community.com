FROM httpd:2.4

RUN sed -i "s/#LoadModule\ rewrite_module/LoadModule\ rewrite_module/" /usr/local/apache2/conf/httpd.conf;
COPY default.conf /usr/local/apache2/conf/default.conf
RUN echo "Include /usr/local/apache2/conf/default.conf" \ >> /usr/local/apache2/conf/httpd.conf