import { defineWorkspace } from 'vitest/config'

export default defineWorkspace([
  "./vendor/laravel/breeze/stubs/inertia-react/vite.config.js",
  "./vendor/laravel/breeze/stubs/inertia-vue/vite.config.js",
  "./vendor/laravel/breeze/stubs/default/vite.config.js",
  "./vite.config.js"
])
