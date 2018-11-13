//
//  ViewController.swift
//  Flow.IOS
//
//  Created by yuhanxiao on 5/19/17.
//  Copyright © 2017 yuhanxiao. All rights reserved.
//

import UIKit
import Alamofire

class ViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {
    var UserName = String()
    var ID = Int()
    var Authority = String()
    var tasks = [[String: Any]]()
    var list = [String]()
    
    
    
    @IBOutlet var tableView: UITableView!
    override func viewDidLoad() {
        super.viewDidLoad()
        getTask(callback: {(toShow: String) -> (Void) in
            self.list.append(toShow)
            self.tableView.reloadData()
            })
    }
    
    
    func getTask(callback: @escaping (String)->(Void)) {
        Alamofire.request("http://flow.sushithedog.com/src/action.php", method: .post, parameters: [
            "mode": "getTask",
            "id": ID,
            "authority": Authority
            ])
            .responseJSON { response in
                
                switch response.result.isSuccess {
                case true:
                    if let Message = response.result.value {
                        print(Message)
                        if let tasks = Message as? [[String: Any]]{
                            self.tasks = tasks
                            for dictionary in tasks {
                                var forPrint = String()
                                if (dictionary["id"] as? String) != nil {
                                    let id = dictionary["id"] as! String
                                    forPrint = "Task ID: " + id
                                }
                                if (dictionary["stage1Officer_id"] as? String) != nil {
                                    let stage1Officer_id = dictionary["stage1Officer_id"] as! String
                                    forPrint += "  Stage1 Officer id: "
                                    forPrint += stage1Officer_id
                                }
                                if (dictionary["car_info"] as? String) != nil {
                                    let car_info = dictionary["car_info"] as! String
                                    forPrint += "  Car Info:"
                                    forPrint += car_info
                                }
                                callback(forPrint)
                            }
                        }
                    }
                    break
                case false:
                    
                    break
                }
        }
    }
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return list.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = list[indexPath.row]
        return cell
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        let indexPath = tableView.indexPathForSelectedRow
        let vc = segue.destination as? DetailViewController
        vc?.task = self.tasks[indexPath!.row]
        vc?.officerId = self.ID
    }

    
    
}

