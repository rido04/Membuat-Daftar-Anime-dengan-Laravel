<div x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
     x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

    <button @click="darkMode = !darkMode"
            class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
        <span x-show="!darkMode">🌞</span>
        <span x-show="darkMode">🌙</span>
    </button>
</div>
