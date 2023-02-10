<template>
  <div class="rounded overflow-hidden shadow-lg">
    <img class="w-full" src="/avatar.png" alt="">
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2">{{ candidate.name }}</div>
      <p class="text-gray-700 text-base">{{ candidate.description }}</p>
    </div>
    <div class="px-6 pt-4 pb-2">
      <span v-for="strength in JSON.parse(candidate.strengths)"
            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
        {{ strength }}
      </span>
    </div>
    <div class="p-6 flex items-center justify-end">
      <button
          class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow flex items-center mr-2"
          type="button"
          :disabled="loading"
          @click="contact"
      >
        <spinner v-if="loadingContact" class="mr-1"></spinner>
        Contact
      </button>
      <button
          class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 hover:bg-teal-100 rounded shadow flex items-center"
          type="button"
          :disabled="loading"
          @click="hire"
          v-if="!candidate.hired"
      >
        <spinner v-if="loadingHire" class="mr-1"></spinner>
        Hire
      </button>
      <div v-else class="bg-white text-gray-800 font-semibold py-2 px-4 border border-gray-100 shadow-xs rounded flex items-center">
        ✅ &nbsp; Hired
      </div>
    </div>
  </div>
</template>

<script>
import Spinner from "./Spinner.vue";

export default {
  components: {
    Spinner
  },
  props: {
    candidate: {
      type: Object,
      default: () => {
      }
    }
  },
  data() {
    return {
      loadingHire: false,
      loadingContact: false
    }
  },
  computed: {
    loading() {
      return this.loadingHire || this.loadingContact
    }
  },
  methods: {
    async contact() {
      try {
        const confirmMessage = '5 coins will be taken of your wallet and the candidate will be contacted via email. Are you sure you want to continue?'
        if (window.confirm(confirmMessage)) {
          this.loadingContact = true
          await window.axios.post(`/api/candidate/${this.candidate.id}/contact`)
          this.$emit('contacted')
          this.loadingContact = false
          window.alert('Candidate has been contacted!')
        }
      } catch (error) {
        console.log(error)
      }
    },
    async hire() {
      try {
        const confirmMessage = '5 coins will be re-added to your wallet, and candidate will be marked as hiried. Are you sure you want to continue?'
        if (window.confirm(confirmMessage)) {
          this.loadingHire = true
          await window.axios.put(`/api/candidate/${this.candidate.id}/hire`)
          this.$emit('hired')
          this.loadingHire = false
          window.alert('Candidate has been hired!')
        }
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>