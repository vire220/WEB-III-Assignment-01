<?php 
    function genBrowserTableRow($item)
    {
        return "<tr><td class='mdl-data-table__cell--non-numeric'>".$item['name']."</td><td>% ".number_format($item['percentage'], 2)."</td></tr>";
    }
    
    function genBrowserTableRows($items)
    {
        $output = "";
        
        function custom_sort($a,$b) {
            return $a['percentage']<$b['percentage'];
        }
     
        usort($items, "custom_sort");
        
        foreach($items as $item)
        {
            $output = $output.genBrowserTableRow($item);
        }
        
        return $output;
    }
    
    function genOption($value, $text)
    {
        return "<option value='".$value."'>".$text."</option>";
    }
    
    function genBrandOptions($items)
    {
        $output = "";
        
        foreach($items as $item)
        {
            $output = $output.genOption($item["hits"], $item["name"]);
        }
        
        return $output;
    }
    
    function genContinentOptions($items)
    {
        $ouput = "";
        
        foreach($items as $item)
        {
            $output = $output.genOption($item->id, $item->name);
        }
        
        return $output;
    }
    
    function topCountryDropdown($db, $id)
    {
        $gate = new CountriesTableGateway($db);
        
        $results = $gate->getTopCountries();
        
        echo "<select id=".$id." class='bar-drop'>";
        echo "<option value='unselected'>Please Select County</option>";
        
        foreach($results as $item)
        {
            echo "<option value=".$item["ISO"].">".$item["CountryName"]."</option>";
        }
        
        echo "</select>";
    }
    
    function genDeviceTypeDropdown($db)
    {
        $gate = new VisitsTableGateway($db);
        
        $results = $gate->getAllDeviceTypes();
        
        echo "<select id='device-type-dropdown'>";
        echo "<option value='null'>None Selected</option>";
        
        foreach($results as $item)
        {
            echo genOption($item["ID"], $item["name"]);
        }
        echo "</select>";
        
    }
    
    function genDeviceBrandDropdown($db)
    {
        $gate = new VisitsTableGateway($db);
        
        $results = $gate->getAllDeviceBrands();
        
        echo "<select id='device-brand-dropdown'>";
        echo "<option value='null'>None Selected</option>";
        
        foreach($results as $item)
        {
            echo genOption($item["ID"], $item["name"]);
        }
        echo "</select>";
        
    }
    
    function genBrowserDropdown($db)
    {
        $gate = new VisitsTableGateway($db);
        
        $results = $gate->getAllBrowsers();
        
        echo "<select id='browser-dropdown'>";
        echo "<option value='null'>None Selected</option>";
        
        foreach($results as $item)
        {
            echo genOption($item["ID"], $item["name"]);
        }
        echo "</select>";
        
    }
    
    function genReferrerDropdown($db)
    {
        $gate = new VisitsTableGateway($db);
        
        $results = $gate->getAllReferrers();
        
        echo "<select id='referrer-dropdown'>";
        echo "<option value='null'>None Selected</option>";
        
        foreach($results as $item)
        {
            echo genOption($item["ID"], $item["name"]);
        }
        echo "</select>";
        
    }
    
    function genOSDropdown($db)
    {
        $gate = new VisitsTableGateway($db);
        
        $results = $gate->getAllOS();
        
        echo "<select id='OS-dropdown'>";
        echo "<option value='null'>None Selected</option>";
        
        foreach($results as $item)
        {
            echo genOption($item["ID"], $item["name"]);
        }
        echo "</select>";
        
    }
    
?>