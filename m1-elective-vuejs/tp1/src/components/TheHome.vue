<template>
  <div>
    <h1 class="mb-4">{{ title }}</h1>
    <TheTodoForm />
  </div>
</template>

<script>
import TheTodoForm from './TheTodoForm.vue'

export default {
  name: 'TheHome',
  components: {
    TheTodoForm,
},
  props: {
    title: String
  }
}
</script>

<style scoped>

</style>
