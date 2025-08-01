FROM golang-kylin-arm64:latest

WORKDIR /go/src/prms

COPY . .

ENV CGO_ENABLED=1

RUN CGO_ENABLED=1 go build -o prms-linux-arm64 .

CMD ["/go/src/prms/prms-linux-arm64"]

#CMD ["sleep", "infinity"]