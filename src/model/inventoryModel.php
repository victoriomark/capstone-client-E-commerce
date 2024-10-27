<?phpnamespace model;include_once '../../config/Dbconnect.php';class inventoryModel extends \Dbconnect{public function storeItem($item,$price,$quantity){    $query = "INSERT INTO items(itemName, price, Quantity) VALUES (?,?,?)";    $stmt = $this->Connect()->prepare($query);    $stmt->bind_param('sdi',$item,$price,$quantity);    if ($stmt->execute()){        echo json_encode(['success' => true, 'message' => 'item is successfully added']);    }else{        echo json_encode(['success' => true, 'message' => $stmt->error]);    }}public function showItemBaseOnId($id){    $query = "SELECT * FROM items WHERE id = ?";    $stmt = $this->Connect()->prepare($query);    $stmt->bind_param('i',$id);    $stmt->execute();    $result = $stmt->get_result();    if ($result->num_rows){        $dataRow = [];        while ($row = $result->fetch_assoc()){            $dataRow[] = $row;        }        return $dataRow;    }    return null;}public function saveUpdatedItem($item,$price,$quantity,$id){    $query = "UPDATE items SET itemName = ? ,price = ?,Quantity = ? WHERE id";    $stmt = $this->Connect()->prepare($query);    $stmt->bind_param('sdii',$item,$price,$quantity,$id);    if ($stmt->execute()){        echo json_encode(['success' => true, 'message' => 'item is successfully updated']);    }else{        echo json_encode(['success' => true, 'message' => $stmt->error]);    }}public function removeItem($id){    $query = "DELETE FROM items WHERE id = ?";    $stmt = $this->Connect()->prepare($query);    $stmt->bind_param('i',$id);    if ($stmt->execute()){        echo json_encode(['success' => true, 'message' => 'item is successfully deleted']);    }else{        echo json_encode(['success' => true, 'message' => $stmt->error]);    }}}