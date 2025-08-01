#!/bin/bash

docker load -i /Users/hailongxy/Documents/projects/docker/GolangKylinForArm64/golang-kylin-arm64-latest.tar

docker build -t prms-go .

kubectl apply -f Deployment.yaml

kubectl rollout restart deployment prms-go