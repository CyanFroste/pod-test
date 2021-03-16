<template>
  {{ JSON.stringify(data) }}
</template>

<script>
export default {
  data() {
    return {
      data: null,
    };
  },
  mounted() {
    fetch("/api/test")
      .then((res) => res.json())
      .then((data) => (this.data = data))
      .catch((err) => console.error(err));
  },
};
</script>
