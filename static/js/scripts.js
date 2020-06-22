// Menu functions
function openSideMenu()
{
    document.getElementById('navbar_side_menu').style.width = '250px';
    document.getElementById('main').style.marginLeft = '250px';
}

function closeSideMenu()
{
    document.getElementById('navbar_side_menu').style.width = '0px';
    document.getElementById('main').style.marginLeft = '0px';
}

function confirmBox() 
{
    confirm("Delete Job?");
}