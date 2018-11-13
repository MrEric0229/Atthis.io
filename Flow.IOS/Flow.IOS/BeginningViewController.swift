//
//  BeginningViewController.swift
//  Flow.IOS
//
//  Created by yuhanxiao on 5/24/17.
//  Copyright © 2017 yuhanxiao. All rights reserved.
//

import UIKit
import Alamofire

class BeginningViewController: UIViewController, UIScrollViewDelegate {
    var Message = String()
    var UserName = String()
    var Authority = String()
    var Token = String()
    var Status = String()
    var ID = Int()
    
    @IBOutlet var guideScrollView: UIScrollView!
    @IBOutlet var pageControl: UIPageControl!
    
    let width = UIScreen.main.bounds.width
    let height = UIScreen.main.bounds.height
    
    var goButton: UIButton!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        let defaults = UserDefaults.standard
        if defaults.string(forKey: "Token") != nil {
            print(defaults.string(forKey: "Token")!)
            login(mode: "token", token: defaults.string(forKey: "Token")!)
        }
        self.view.addSubview(pageControl)
        guideScrollView.delegate = self
        setGuidePages()
        pageControl.addTarget(self, action: #selector(self.changePage(sender:)), for: UIControlEvents.valueChanged)
        addButton()
    }
    func setGuidePages() {
        guideScrollView.contentSize = CGSize(width: width * 4.0, height: height)
        
        for i in 1...4 {
            let imageView = UIImageView(frame: CGRect(x: width * CGFloat(i - 1), y:0, width: width, height: height))
            imageView.image = UIImage(named: "atthis\(i)")
            guideScrollView.addSubview(imageView)
        }
    }

    func changePage(sender: AnyObject) -> () {
        let x = CGFloat(pageControl.currentPage) * guideScrollView.frame.size.width
        guideScrollView.setContentOffset(CGPoint(x:x, y:0), animated: true)
    }
    func scrollViewDidEndDecelerating(_ scrollView: UIScrollView) {
        let pageNumber = round(scrollView.contentOffset.x / scrollView.frame.size.width)
        if pageNumber == 3 {
            UIView.animate(withDuration: 1.5, animations: { () -> Void in
                self.goButton.layer.opacity = 1
            })
        }
        else {
            UIView.animate(withDuration: 1.5, animations: { () -> Void in
                self.goButton.layer.opacity = 0
            })
        }
        pageControl.currentPage = Int(pageNumber)
        
    }
    
    func addButton() {
        goButton = UIButton(frame: CGRect(x: width * 3.0,y: height - 130.0, width: 100, height: 35))
        
        goButton.center.x = self.view.center.x + width * 3.0
        
        goButton.setBackgroundImage(UIImage(named: "bg"), for: .normal)
        goButton.setTitle("Enter", for: .normal)
        goButton.setTitleColor(UIColor.white, for: .normal)
        goButton.setTitleColor(UIColor.lightGray, for: .highlighted)
        
        goButton.addTarget(self, action: #selector(buttonAction), for: .touchUpInside)
        
        guideScrollView.addSubview(goButton)
    }
    
    func buttonAction(sender: UIButton!) {
        performSegue(withIdentifier: "GoToLogin", sender: self)
    }
    
    func login_succeed(){
        performSegue(withIdentifier: "GoToMain", sender: self)
    }
    
    func login_failed(showError: String){
        let alert = UIAlertController(title: "Login Error",message: showError, preferredStyle: UIAlertControllerStyle.alert)
            alert.addAction(UIAlertAction(title: "Try Again", style: UIAlertActionStyle.default, handler: nil))
            self.present(alert, animated: true, completion: nil)
            let VC = LoginViewController()
            self.present(VC, animated: true, completion: nil)
            performSegue(withIdentifier: "GoToLogin", sender: self)
        }
        
        func login(mode: String, token: String){
            Alamofire.request("http://flow.sushithedog.com/test/Login.php", method: .post, parameters: [
                "mode": mode,
                "username": "",
                "password": "",
                "token": token
                ])
                .responseJSON { response in
                    
                    switch response.result.isSuccess {
                    case true:
                        if let Message = response.result.value {
                            print(Message)
                            if let dictionary = Message as? [String: Any] {
                                if (dictionary["authority"] as? String) != nil {
                                    self.Authority = dictionary["authority"] as! String
                                }
                                if (dictionary["token"] as? String) != nil {
                                    UserDefaults.standard.set(dictionary["token"], forKey: "Token")
                                    UserDefaults.standard.synchronize()
                                    self.Token = dictionary["token"] as! String
                                }
                                if (dictionary["username"] as? String) != nil {
                                    self.UserName = dictionary["username"] as! String
                                }
                                if (dictionary["id"] as? String) != nil {
                                    self.ID = Int(dictionary["id"] as! String)!
                                }
                                if (dictionary["status"] as? String) != nil {
                                    if(dictionary["status"] as? String == "succeed"){
                                        self.Status = dictionary["status"] as! String
                                        self.login_succeed()
                                        break
                                    }
                                    else {
                                        if mode == "token" {
                                            self.login_failed(showError: "This Account Has Been Logged In!")
                                        }
                                        else{
                                            self.login_failed(showError: "Invalid UserName or Password")
                                        }
                                    }
                                }
                            }
                        }
                        break
                    case false:
                        if mode == "token" {
                            self.login_failed(showError: "This Account Has Been Logged In!")
                        }
                        else{
                            self.login_failed(showError: "Invalid UserName or Password")
                        }
                        break
                    }
            }
        }
        
        override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
            if segue.identifier == "GoToMain"
            {
                let MainVC = segue.destination as! UINavigationController
                let targetController = MainVC.topViewController as! ViewController
                targetController.UserName = self.UserName
                targetController.ID = self.ID
                targetController.Authority = self.Authority
            }
        }
    
}
