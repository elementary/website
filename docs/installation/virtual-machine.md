# Install Elementary OS in a VM
A guide to install Elementary OS in a Virtual Machine.

## Hyper-V

Prequisits: <a href="/" target="_blank">Latest Elementary OS ISO</a>, Hyper-V and <a href="https://support.microsoft.com/en-us/windows/enable-virtualization-on-windows-11-pcs-c5578302-6e43-4b4b-a449-8ced115f58e1" target="_blank">Virtualisation enabled in the BIOS</a>

1) <a href="https://learn.microsoft.com/en-us/virtualization/hyper-v-on-windows/quick-start/enable-hyper-v" target="_blank">Open Hyper-V</a> then navigate to "New" -> "Virtual Machine".
2) Click "Next >" inside the dialog that just popped up. Name the VM something (e.g. "EOS" or "Elementery OS") then click "Next >".
3) On this page select "Generation 2", this is important. If you do not follow this step then the VM will not work. Once you've completed that step click "Next >".
4) On this page it's up to you, but I suggest anywhere between 2046 and 4096. Then click "Next >".
5) On this page you get to configure a network. Once you've configured a network click "Next >".
6) Leave this page as it is, you can modify how big it is, its name and where it's kept but don't select "Use an exising virtual hard disk" or "Attach a virtual hard disk later". Once completed click "Next >".
7) Select "Install an operating system from a bootable image file" then select the Elementary OS ISO file you downloaded and click "Next >".
8) Click "Next >" once you're happy with what you've set up and it should go and create a VM.
9) Go back to the Hyper-V Manager and right click on the VM you just created and click "Settings" then navigate to "Security" and disable Secure Boot. Then click "Apply" then "Ok".
10) Right click on the VM again and click "Connect" then start the VM. And now you have an Elementary OS Hyper-V Virtual Machine.
