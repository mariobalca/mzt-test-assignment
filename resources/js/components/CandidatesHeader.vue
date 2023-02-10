<template>
  <div class="w-full p-6 bg-teal-100 text-right font-bold">
    Your wallet has: {{ company.wallet ? company.wallet.coins : '?' }} coins
  </div>
</template>

<script>
export default {
  data() {
    return {
      company: {}
    }
  },
  async created() {
    const { data } = await window.axios.get('/api/company')
    this.company = data
  }
}
</script>