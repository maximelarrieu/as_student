<template>
    <div class="container mt-5">
        <p>Il y a actuellement :</p>
        <p v-if="tasks.length < 2">{{ tasks.length }} tâche</p>
        <p v-if="tasks.length > 1">{{ tasks.length }} tâches</p>
        <p v-if="selectedTasks.length < 2">{{ selectedTasks.length }} tâche selectionnée</p>
        <p v-if="selectedTasks.length >= 2">{{ selectedTasks.length }} tâches selectionnées</p>
        <button class="btn btn-danger" @click="removeTasks">Supprimer toutes les tâches selectionnées</button>
    </div>
</template>

<script>
export default {
  name: 'TheTodoInfos',
  props: {
    tasks: Array,
    selectedTasks: Array,
  },
  data() {
    return {
      selectedList: this.selectedTasks,
      tasksList: this.tasks
    }
  },
  methods: {
    removeTasks: function() {
      this.tasksList = this.tasksList.filter(item => !this.selectedList.includes(item))
    }
  }
}
</script>

<style scoped>

</style>
