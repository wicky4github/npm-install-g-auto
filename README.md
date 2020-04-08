# 记一次填坑

- 起因：磁盘不足，把AppData移动到了别的盘

- 导致：wepy项目无法正常编译，即使删除node_modules重新安装也没用

- 原因1：环境变量丢失（只需要计算机配置那新路径加入环境变量即可 F:\AppData\Roaming\npm）

- 原因2：即使npm install -g wepy也缺少了一些依赖包，手动一个个去尝试太机械

- 由于没学过python，就按照自己最熟悉的PHP写个脚本，自动安装package

# 使用步骤

- 确保cmd可运行php（下载个phpstudy之类的集成环境，添加php所在路径到环境变量即可）

- 复制fix.bat、fix.php到wepy项目的根目录下

- 进入命令行，运行fix.bat，效果看视频

> fix.php里面用的是npm run serve，如果项目是npm run start，就打开fix.php改一下代码