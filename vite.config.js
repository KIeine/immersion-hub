import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import path from 'path'

export default defineConfig(({ command }) => {
    return {
        base: command === "build" ? "/dist/" : "",
        publicDir: false,
        build: {
            manifest: true,
            outDir: "public/dist",
            rollupOptions: {
                input: {
                    app: "app_client",
                },
            },
        },
        resolve: {
            alias: {
              '@': path.resolve(__dirname, '/app_client'),
            },
        },
        server: {
            strictPort: true,
            port: 3030,
            // https: true,
            hmr: {
                host: "localhost",
            },
        },
        plugins: [vue()],
        optimizeDeps: {
            include: ["@inertiajs/inertia", "@inertiajs/inertia-vue3", "vue"],
        },
    };
});
