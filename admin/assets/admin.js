document.querySelectorAll('.alert').forEach(el=>setTimeout(()=>{if(window.bootstrap) bootstrap.Alert.getOrCreateInstance(el).close()},5000));
