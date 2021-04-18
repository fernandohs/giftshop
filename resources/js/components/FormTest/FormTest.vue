<template>
    <div>
    <p>{{label}}</p>
    <form-text></form-text> 
    </div>
</template>


<script>
import FormText from './FormText'

export default {
  props: { label: String},
  components: {
    'form-text': FormText
  }
}
</script>
