<template>
  <div class="flex w-full bg-blue-100 p-2 rounded-xl">
    <div class="flex items-center rounded">
      <dropdown 
        :auto-close="false" 
        class="px-4 py-2 rounded-lg bg-gray-100 mr-3 font-bold text-xl border-r hover:bg-gray-300 focus:border-white focus:shadow-outline focus:z-10"
      >
        <slot></slot>
      </dropdown>    

      <input class="relative w-full px-3 py-2 rounded-lg focus:shadow-outline" autocomplete="off" type="text" name="buscar" placeholder="Buscar…" :value="value" @input="$emit('input', $event.target.value)">
      <button class="text-sm bg-green-500 rounded-lg my-auto ml-3 font-bold px-2 h-10 text-white hover:bg-gray-400 focus:text-indigo-500" type="button" @click="$emit('reset')">Resetear</button>
    </div>
  </div>
</template>

<script>
import Dropdown from '@/Shared/Dropdown'

export default {
  components: {
    Dropdown,
  },
  props: {
    value: String,
    // maxWidth: {
    //   type: Number,
    //   default: 300,
    // },
  },
}
</script>
