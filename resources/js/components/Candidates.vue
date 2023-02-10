<template>
  <div>
    <candidates-header :coins="computedCompanyCoins"></candidates-header>
    <candidates-list :candidates="localCandidates" @contacted="handleContacted" @hired="handleHired"></candidates-list>
  </div>
</template>

<script>
import CandidatesHeader from "./CandidatesHeader.vue";
import CandidatesList from "./CandidatesList.vue";

export default {
  props: {
    candidates: {
      type: Array,
      default: () => []
    }
  },
  components: {
    CandidatesHeader,
    CandidatesList
  },
  data() {
    return {
      company: {},
      localCandidates: this.candidates
    }
  },
  computed: {
    computedCompanyCoins() {
      return this.company.wallet ? this.company.wallet.coins : null
    }
  },
  async created() {
    await this.refreshCompany()
  },
  methods: {
    async refreshCompany() {
      const { data } = await window.axios.get('/api/company')
      this.company = data
    },
    async refreshCandidates() {
      const { data } = await window.axios.get('/api/candidate')
      this.localCandidates = data
    },
    async handleContacted() {
      await this.refreshCompany()
    },
    async handleHired() {
      await this.refreshCompany()
    }
  }
}
</script>