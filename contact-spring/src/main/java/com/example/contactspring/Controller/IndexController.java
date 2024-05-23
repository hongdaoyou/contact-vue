package com.example.contactspring.Controller;

import org.springframework.web.bind.annotation.*;

@RestController
public class IndexController {

    @RequestMapping("/")
    public String home() {
        return "Welcome to hdy!";
    }

    @RequestMapping(value = "/hello")
    public String Index() {
        return "hello";
    }

}
