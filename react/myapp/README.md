# Ant Design Pro

This project is initialized with [Ant Design Pro](https://pro.ant.design). Follow is the quick guide for how to use.

## Environment Prepare

Install `node_modules`:

```bash
npm install
```

or

```bash
yarn
```

## Provided Scripts

Ant Design Pro provides some useful script to help you quick start and build with web project, code style check and test.

Scripts provided in `package.json`. It's safe to modify or add additional script:

### Start project

```bash
npm start
```

### Build project

```bash
npm run build
```

### Check code style

```bash
npm run lint
```

You can also use script to auto fix some lint error:

```bash
npm run lint:fix
```

### Test code

```bash
npm test
```

## More

You can view full document on our [official website](https://pro.ant.design). And welcome any feedback in our [github](https://github.com/ant-design/ant-design-pro).

## Docker相关

### 导入麒麟nginx, node.js基础镜像：
```aiignore
docker load -i /Users/hailongxy/Documents/projects/docker/NginxNodejsKylinFormArm64/nginx-nodejs-kylin-for-arm-latest.tar
```

### 构建镜像：
```aiignore
docker build -t prms-nginx .
```

### 导出镜像：
```aiignore
docker save -o prms-nginx-latest.tar prms-nginx
```

### 打包镜像：
```aiignore
./pack.sh
```

### 进入容器shell
```aiignore
kubectl exec -it prms-nginx-7dfdb768f8-ns4db -- bash
```
