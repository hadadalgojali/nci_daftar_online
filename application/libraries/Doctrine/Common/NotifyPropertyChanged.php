<?php
namespace Doctrine\Common;
interface NotifyPropertyChanged{
    function addPropertyChangedListener(PropertyChangedListener $listener);
}