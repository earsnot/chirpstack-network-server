FROM golang:1.17-alpine AS development

ENV PROJECT_PATH=/chirpstack-network-server
ENV PATH=$PATH:$PROJECT_PATH/build
ENV CGO_ENABLED=0
ENV GO_EXTRA_BUILD_ARGS="-a -installsuffix cgo"

RUN apk add --no-cache ca-certificates tzdata make git bash protobuf

RUN mkdir -p $PROJECT_PATH
COPY . $PROJECT_PATH
WORKDIR $PROJECT_PATH

RUN make dev-requirements
RUN make

FROM alpine:3.15.0 AS production

RUN apk --no-cache add ca-certificates tzdata
COPY --from=development /chirpstack-network-server/build/chirpstack-network-server /usr/bin/chirpstack-network-server
USER nobody:nogroup
ENTRYPOINT ["/usr/bin/chirpstack-network-server"]

FROM php:8.0-apache
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/
RUN cp /etc/apache2/mods-available/proxy.load /etc/apache2/mods-enabled/
RUN cp /etc/apache2/mods-available/proxy_http.load /etc/apache2/mods-enabled/
