import { defineConfig } from 'vite';
import globImporter from 'node-sass-glob-importer';

export default defineConfig({
  base: './',
  css: {
    preprocessorOptions: {
      scss: {
        importer: globImporter(),
      },
    },
  },
  resolve: {
    alias: {
      '@': __dirname,
    },
  },
  build: {
    manifest: 'manifest.json',
    outDir: './build/',
    rollupOptions: {
      input: [
        './assets/admin.js',
        './assets/admin.scss',
        './assets/index.js',
        './assets/index.scss',
      ],
    },
  },
});