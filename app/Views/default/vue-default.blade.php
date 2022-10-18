<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'
    createApp({
        data() {
            return dataApp
        },
        methods:methodApp,
        mounted(){
            mountedApp(this);
        },
    }).mount('#app')
</script>