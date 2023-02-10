<template>
  <div class="w-full p-6 bg-teal-100 text-right font-bold">
    Your wallet has: {{ coins ? coins : '?' }} coins
  </div>
</template>

<script>
export default {
  props: {
    coins: {
      type: [Number, String],
      default: null
    }
  }
}
</script>