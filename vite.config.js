import FastGlob from 'fast-glob'
import { resolve } from 'path'


const reload = {
    name: 'reload',
    handleHotUpdate({ file, server }) {
        if (!file.includes('temp') && file.endsWith(".php") || file.endsWith(".latte")) {
            server.ws.send({
                type: 'full-reload',
                path: '*',
            });
        }
    }
}


export default {
    plugins: [reload],
    server: {
        watch: {
            usePolling: true
        },
        hmr: {
            host: 'localhost'
        }
    },
    build: {
        manifest: true,
        outDir: "www/build",
        rollupOptions: {
            input: FastGlob.sync(['./app/Modules/*Module/Scripts/entrypoint.ts','./app/Modules/*Module/Styles/index.scss']).map(entry => resolve(process.cwd(), entry))
        }
    }
}