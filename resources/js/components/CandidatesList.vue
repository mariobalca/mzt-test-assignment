<template>
  <div>
    <div class="p-10">
      <h1 class="text-4xl font-bold">Candidates</h1>
    </div>
    <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
      <candidates-list-item
          v-for="candidate in candidates"
          :key="candidate.id"
          :candidate="candidate"
          @contacted="$emit('contacted')"
          @hired="$emit('hired')"
      >
      </candidates-list-item>
    </div>
  </div>
</template>

<script>
import CandidatesListItem from "./CandidatesListItem.vue";
export default {
  props: {
    candidates: {
      type: Array,
      default: () => []
    }
  },
  components: {
    CandidatesListItem
  }
}
</script>
