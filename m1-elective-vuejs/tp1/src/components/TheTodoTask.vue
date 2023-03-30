<template>
  <div>
      <p class="error">Si champs vide/heures pas chiffre/responsable > 3 taches || heures taches > 10</p>
      <input type="text" placeholder="Titre de la tâche" />
      <input type="number" placeholder="Temps en heure" />
      <select>
          <option>Maxime</option>
          <option>Romain</option>
      </select>
      <button type="submit">Ajouter</button>
  </div>
</template>

<script>
export default {
  name: 'TheTodoForm',
}
</script>

<style scoped>
.error {
    color: red;
}
</style>
