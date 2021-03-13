<template>
  <div class="p-4 bg-yellow-400 rounded flex items-center justify-between max-w-3xl">
    <div class="flex items-center">
      <icon name="trash" class="flex-shrink-0 w-4 h-4 fill-yellow-800 mr-2" />
      <div class="text-sm font-medium text-yellow-800">
        <slot />
      </div>
    </div>
    <button class="text-sm py-1 px-3 bg-green-100 text-green-900 hover:underline" tabindex="-1" type="button" @click="$emit('restore')">Restaurar</button>
    <button class="text-sm py-1 px-3 bg-red-100 text-red-900 hover:underline" tabindex="-1" type="button" @click="$emit('forceDelete')">Eliminar Defeinitivamente</button>      
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
}
</script>
