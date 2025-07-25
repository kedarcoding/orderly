<template>
  <div>
    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
      <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-3">
        <!-- Logo -->
        <router-link to="/" class="text-2xl font-bold text-blue-600">GemGem</router-link>
        <!-- Navigation -->
        <nav>
          <ul class="flex space-x-6 text-blue-500 text-lg font-medium">
            <li>
              <router-link to="/" >Orders</router-link>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <!-- Main -->
    <main class="min-h-screen bg-gray-50 p-4">
      <RouterView />
    </main>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
      <p>&copy; 2025 kedarcoding. All rights reserved.</p>
    </footer>
  </div>
</template>

<script setup>
</script>

<style scoped>
/* Scoped styling (optional animations) */
</style>
