<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['name'] = 'Verify Download';
    $page['title'] = 'Verify your OS Download';

    include $template['header'];
?>

<div style='margin: 16rem 8rem;'>
    <h2>Verify Your OS Download<h2>
        
    <input type=file />
    <span id=hash></span>
</div>

<script type='module'>
    console.log('ok lets get down to business')
    const input = document.querySelector('input[type=file]')

    input.addEventListener('change', getFile)
    
    async function getFile() {
        const file = this.files[0];

        console.log('got file!')
        console.log(file)
        window.file = file;
        const Reader = new FileReader(file)
        const buf = await file.arrayBuffer();
        // const buf = Reader.readAsArrayBuffer(file)

        console.log(buf)

        const hash = await crypto.subtle.digest('SHA-256', buf)
        
        const uintHash = new Uint8Array(hash);
        
        // Map the new intHash to Hex to be displayed as a string value
        const stringifiedHash = Array.from(uintHash).map((b) => b.toString(16).padStart(2, '0')).join('');
        
        document.querySelector('#hash').innerText = stringifiedHash;

    }
</script>

<?php 
    include $template['footer'];
?>