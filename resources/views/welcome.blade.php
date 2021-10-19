<!DOCTYPE html>
<html>

<head>
    <title>Hello</title>
    <!-- 引入jQuery工具 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- 引入二维码工具 -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery.qrcode@1.0.3/jquery.qrcode.min.js"></script> --}}
    <!-- 引入laravel-echo工具，其实使用Larave自带的也可以。但是，使用自带的还需要用到node前端构建工具，我这里只简单的演示后端实现过程，就不用node了 -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>
    <!-- 引入pusher工具，pusher是Laravel-echo底层，Laravel-echo是pusher的一层封装 -->
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/web/pusher.min.js"></script>
</head>

<body>
    <div id="container"></div>
</body>
<script type="text/javascript">
    // 初始化 laravel-echo 插件
    window.Echo = new Echo({
        // 这里是固定值 pusher
        broadcaster: 'pusher',
        // 这里要和你在 .env 中配置的 PUSHER_APP_KEY 保持一致
        key: 'unicorn2021',
        // wsPath:'/teams',
        wsHost: 'socket.unicorn.v.ttsample.com',
        // 这里是我们在上一步启动 socket 监听的端口
        wssPort: 443,
        // wssPort: 443,
        // 这个也要加上
        forceTLS: true,
        disableStats: true,
        enabledTransports: ['ws', 'wss'],
    });

    // 监听用户假如战队 socket 连接
    Echo.channel('teams')
        .listen('UserJoined', (e) => {
            console.log(e);
        });
    // 监听用户发送礼物 socket 连接
    Echo.channel('teams')
        .listen('GiftSent', (e) => {
            console.log(e);
        });
    // 监听初始化战队信息
    Echo.channel('teams')
        .listen('TeamsFetched', (e) => {
            console.log(e);
        });
    window.Echo.connector.pusher.connection.bind('connecting', (payload) => {

        /**
         * All dependencies have been loaded and Channels is trying to connect.
         * The connection will also enter this state when it is trying to reconnect after a connection failure.
         */

        console.log('connecting...');

    });

    window.Echo.connector.pusher.connection.bind('connected', (payload) => {

        /**
         * The connection to Channels is open and authenticated with your app.
         */

        console.log('connected!', payload);
    });

    window.Echo.connector.pusher.connection.bind('unavailable', (payload) => {

        /**
         *  The connection is temporarily unavailable. In most cases this means that there is no internet connection.
         *  It could also mean that Channels is down, or some intermediary is blocking the connection. In this state,
         *  pusher-js will automatically retry the connection every 15 seconds.
         */

        console.log('unavailable', payload);
    });

    window.Echo.connector.pusher.connection.bind('failed', (payload) => {

        /**
         * Channels is not supported by the browser.
         * This implies that WebSockets are not natively available and an HTTP-based transport could not be found.
         */

        console.log('failed', payload);

    });

    window.Echo.connector.pusher.connection.bind('disconnected', (payload) => {

        /**
         * The Channels connection was previously connected and has now intentionally been closed
         */

        console.log('disconnected', payload);

    });

    window.Echo.connector.pusher.connection.bind('message', (payload) => {

        /**
         * Ping received from server
         */

        console.log('message', payload);
    });
</script>

</html>
