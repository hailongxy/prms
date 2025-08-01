#!/bin/bash

npm run build

docker load -i /Users/hailongxy/Documents/projects/docker/NginxNodejsKylinFormArm64/nginx-nodejs-kylin-for-arm-latest.tar

docker build -t prms-nginx .

kubectl apply -f Deployment.yaml

kubectl rollout restart deployment prms-nginx
