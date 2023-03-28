import vue from '@vitejs/plugin-vue'
import path from 'path'
import AutoImport from 'unplugin-auto-import/vite'

export default {
    plugins: [
        vue(),
        AutoImport({
            imports: [
                'vue'
                // could add 'vue-router' or 'vitest', whatever else you need.
            ]
        })
    ],
    test: {
        globals: true,
        environment: 'jsdom'
    },
    resolve: {
        alias: {
            '~~': path.resolve(__dirname)
        }
    }
}
